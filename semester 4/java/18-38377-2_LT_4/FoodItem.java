public class FoodItem {
  private double price;
  private String name;

  public FoodItem() {}
  public FoodItem(double price, String name) {
    this.price = price;
    this.name = name;
  }
  public void setPrice(double price) { this.price = price; }
  public void setName(String name) { this.name = name; }
  public String getName() { return name; }
  public double getPrice() { return price; }

  public void showDetails() {
    System.out.println("name: " + name);
    System.out.println("price: " + price);
  }
}