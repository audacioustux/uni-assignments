public class Start {
  public static void main(String args[]) {
    Book b1 = new Book("42", "wubba lubba dub dub", "tanjim", 2022);
    Book b2 = new Book("2", "java to c#", "MOHAIMEN BIN NOOR", 2020);
    Book b3 = new Book("3", "snapping 101", "MOHAIMEN BIN NOOR", 2019);
    Book b4 = new Book("4", "jadumontro", "MOHAIMEN BIN NOOR", 2020);

    Book books[] = {b1, b2, b3, b4, null};

    for (int i = 0; i < books.length; i++) {
      if (books[i] != null)
        books[i].showDetails();
    }

    books[2] = null;

    for (int i = 0; i < books.length; i++) {
      if (books[i] != null)
        books[i].showDetails();
    }
  }
}