package entities;

public class Category {
    private int id;
    private String name;
    private String description;

    public Category(int id) {
        this.id = id;
    }

    public Category(int id, String name) {
        this(id);
        this.name = name;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }
}