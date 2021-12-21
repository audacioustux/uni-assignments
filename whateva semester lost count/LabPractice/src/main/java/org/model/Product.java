package org.model;

import javax.validation.constraints.Max;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Pattern;

public class Product {
    @NotNull
    private int productId;

    @NotNull
    @Pattern(regexp = "^[A-Za-z]*$")
    private String productName;

    @NotNull
    @Min(value = 0)
    @Max(value = 1000)
    private int quantity;

    @NotNull
    private String productCategory;

    public Product() {}

    public Product(int productId, String productName, int quantity, String productCategory) {
        this.productId = productId;
        this.productName = productName;
        this.quantity = quantity;
        this.productCategory = productCategory;
    }

    public int getProductId() {
        return productId;
    }

    public void setProductId(int productId) {
        this.productId = productId;
    }

    public int getQuantity() {
        return quantity;
    }

    public void setQuantity(int quantity) {
        this.quantity = quantity;
    }

    public String getProductName() {
        return productName;
    }

    public void setProductName(String productName) {
        this.productName = productName;
    }

    public String getProductCategory() {
        return productCategory;
    }

    public void setProductCategory(String productCategory) {
        this.productCategory = productCategory;
    }
}
