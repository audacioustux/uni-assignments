public class Start {
  public static void main(String args[]) {
    Pizza p1 = new Pizza();
    p1.setSize("big");
    p1.setPrice(4.99);
    p1.setName("moxareala pijza");
    p1.showDetails();
    System.out.println("size: " + p1.getSize());

    Pizza p2 = new Pizza("huge", 9.99, "pepeirony pixa");
    p2.showDetails();
    System.out.println("size: " + p2.getSize());

    Burger b1 = new Burger();
    b1.setNumberOfPatties(2);
    b1.setPrice(4.99);
    b1.setName("moxareala baggar");
    b1.showDetails();
    System.out.println("NumberOfPatties: " + b1.getNumberOfPatties());

    Burger b2 = new Burger(3, 9.99, "pepeirony baggar");
    b2.showDetails();
    System.out.println("NumberOfPatties: " + b2.getNumberOfPatties());
  }
}