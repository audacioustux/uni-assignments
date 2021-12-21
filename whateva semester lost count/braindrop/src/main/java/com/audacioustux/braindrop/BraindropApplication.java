package com.audacioustux.braindrop;

import com.audacioustux.braindrop.configuration.AppProperties;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.context.properties.EnableConfigurationProperties;

@SpringBootApplication
@EnableConfigurationProperties(AppProperties.class)
public class BraindropApplication {

    public static void main(String[] args) {
        SpringApplication.run(BraindropApplication.class, args);
    }

}
