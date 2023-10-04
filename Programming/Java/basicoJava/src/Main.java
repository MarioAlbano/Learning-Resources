import java.util.Scanner;
public class Main {
    public static void main(String[] args) {
    Scanner scanner = new Scanner(System.in);
        System.out.println("Enter with you name, please: ");
        String userInput = scanner.nextLine();
        System.out.println("Please, now enter with your age");
        int userInput2 = scanner.nextInt();


        System.out.printf(String.format("My name is %s, and I am %d years old", userInput, userInput2));

        scanner.close();
    }
}