package com.Activities;
import java.util.Scanner;
import java.util.ArrayList;	
	
public class NameStorage {

	public static void main(String[] args) {
		ArrayList<String> name = new ArrayList<String>();
		
		char choice;
		Scanner s = new Scanner(System.in);

		do{
		System.out.println("---------------------");
		System.out.println("Name Storage");
		System.out.println("A = Store a name");
		System.out.println("B = Search a name");
		System.out.println("X = Exit");
		System.out.println("---------------------");
		System.out.println("Enter your choice: ");
		choice = s.nextLine().charAt(0);
		
		if(choice == 'A' ||choice == 'a') {
			System.out.println("---------------------");
			System.out.println("Enter Name: ");
			name.add(s.nextLine());
			System.out.println("Your Name is Stored \n");
		}
		
		else if (choice == 'B' ||choice == 'b') {
			System.out.println("---------------------");
			System.out.println("Search Name: ");
			boolean has = name.contains(s.nextLine());
			if(has) {
				System.out.println("The Name is in the Storage\n");
			}else {
				System.out.println("Your Name is not in the Storage");
			}
		}
		
		
		
		
		}while( choice != 'x'  );
		
		
		System.out.println("The Program is Finish...");
		
		
		}
		
		
	}



