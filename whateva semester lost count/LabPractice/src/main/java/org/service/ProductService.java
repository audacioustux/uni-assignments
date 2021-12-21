package org.service;

import java.util.List;

import org.model.Product;
import org.springframework.stereotype.Service;

@Service
public class ProductService {
    private static List<Product> products;

    public static Product insert(int productId, String productName, int quantity, String productCategory) {
        Product product = new Product(productId, productName, quantity, productCategory);
        products.add(product);
        return product;
    }
}
