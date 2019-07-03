public class Book {
  private String bookId;
  private String bookTitle;
  private String authorName;
  private int publicationYear;

  public Book() {}
  public Book(String bookId, String bookTitle, String authorName,
              int publicationYear) {
    this.bookId = bookId;
    this.bookTitle = bookTitle;
    this.authorName = authorName;
    this.publicationYear = publicationYear;
  }

  public void showDetails() {
    System.out.println("bookId: " + bookId);
    System.out.println("bookTitle: " + bookTitle);
    System.out.println("authorName: " + authorName);
    System.out.println("publicationYear: " + publicationYear);
  }
}