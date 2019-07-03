public class Pizza extends FoodItem {
  private String size;
  public Pizza() {}
  public Pizza(String size, double price, String name) {
    super(price, name);
    this.size = size;
  }
  public void setSize(String size) { this.size = size; }
  public String getSize() { return size; }
}