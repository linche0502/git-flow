#include <iostream>
#include <vector>
#include <map>
using std::cout;
using std::vector;
using std::map;

class Dice{
public:
    int top= 1;
};





int main(){
    Dice d1= Dice();
    Dice d2= Dice();
    d1.top= 2;
    cout << d2.top;
    
    return 0;
}