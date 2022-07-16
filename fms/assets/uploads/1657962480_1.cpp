/******************************************************************************

                              Online C++ Compiler.
               Code, Compile, Run and Debug C++ program online.
Write your code in this editor and press "Run" button to compile and execute it.

*******************************************************************************/

#include <iostream>

using namespace std;

int main()
{/******************************************************************************

                              Online C++ Compiler.
               Code, Compile, Run and Debug C++ program online.
Write your code in this editor and press "Run" button to compile and execute it.

*******************************************************************************/

#include <iostream>
//Kai's Shawarma Kiosk//
using namespace std;

int main()
{
    int dami;
    char Shawarma;
    int dagdag,onions = 20, cheese = 35, ammount_due;
    int price_a = 95,price_b = 90, price_c = 100;
    cout<<"//////////////////////////////////////////////"; 
    cout<<"\n           Kai's Shawarma Kiosk"; 
    cout<<"\n/////////////////////////////////////////////";
    cout<<"\nShawarma Meat Variety: ";
    cout<<"\na. Pork...... P 95"; 
    cout<<"\nb. Beef...... P 90"; 
    cout<<"\nc. Chicken... P 100"; 
    cout<<"\nPlease Choose Meat Variety: ";
    cin>>Shawarma;
    cout<<"\nHow many Shawarma: ";
    cin>>dami;
    cout<<"\nAdd-ons: ";
    cout<<"\n1. Onions ... P 20";
    cout<<"\n2. Cheese ... P 35";
    cout<<"\nSelect Add-ons: ";
    cin>>dagdag;
    cout<<"\n-*-*-*-*-*-*-*-*-*-*-*\n";
   
    if((Shawarma == 'a' || Shawarma == 'A') ){
       
        ammount_due = price_a * dami;
        cout<<"\nPork        : "<<dami;
         if( dagdag == 1 ){
            cout<<"\nAdd-ons   : "<<"Onions";
            ammount_due = ammount_due + onions;
         }
        else if( dagdag == 2 ){
            cout<<"\nAdd-ons   : "<<"Cheese";
            ammount_due = ammount_due  + cheese;
        }
        cout<<"\nAmount Due: "<<ammount_due ;
        
    }
 
    
    return 0;
}
