import org.springframework.web.bind.annotation.*;

import javax.tools.JavaCompiler;
import javax.tools.ToolProvider;
import java.io.File;
import java.io.IOException;
import java.lang.reflect.Method;
import java.net.URL;
import java.net.URLClassLoader;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;

@RestController
public class WebController{

    @CrossOrigin(origins = "*")
    @RequestMapping(value = "/simpleoj",method = RequestMethod.POST, headers = "Accept=text/plain")
    public String greetings(@RequestBody String bodyContent) throws Exception{

        String source =  bodyContent;
        System.out.println(source);
        File folder = new File("./src/main/java/com/imooc/controller");
        File sourceFile = new File(folder, "Solution.java");
        try {
            Files.write(sourceFile.toPath(), source.getBytes(StandardCharsets.UTF_8));
        } catch (IOException e) {
            e.printStackTrace();
        }
        JavaCompiler compiler = ToolProvider.getSystemJavaCompiler();
        if (compiler == null) {
            System.out.println("JDK required (running inside of JRE)");
        } else {
            System.out.println("you got it!");
        }

        int compilationResult = compiler.run(null, null, null, sourceFile.getPath());
        if (compilationResult == 0) {
            System.out.println("Compilation is successful");
        } else {
            System.out.println("Compilation Failed");
        }
        try {
            URLClassLoader classLoader = URLClassLoader.newInstance(new URL[] {folder.toURI().toURL() });
            Class<?> cls = Class.forName("Solution", true, classLoader);
            Object instance = cls.newInstance();
            Method method = cls.getDeclaredMethod("add", null);
            System.out.println(method.invoke(instance, null));
            Integer res = (Integer) method.invoke(instance, null);

            //delete temp file
            File classfile = new File(folder, "Solution.class");
            sourceFile.delete();
            classfile.delete();
            return res.toString();
        } catch (Exception e) {
            e.printStackTrace();
            sourceFile.delete();
            return "something wrong";
        }
    }
}
