#include <iostream>
#include <fstream>

using namespace std;

int main()
{
        char input[128*1024];
        cin.getline(input, (128*1024));
        fstream file;
        file.open("test.txt", ios::binary | ios::trunc | ios::app);
        cout << "Content-type: text/html\r\n\r\n";
        for (int x = 0; x < (128*1024); x++) 
        {
                cout << input[x];  // should work for a text file
                file << input[x];
        }
        return 0;
}