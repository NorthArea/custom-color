#include <iostream>
#include <cstdlib>

using namespace std;

int main () {
   cout << "Content-type:text/html\r\n\r\n";
   cout << "<html>\n";
   cout << "<head>\n";
   cout << "<title>Hello World - First CGI Program</title>\n";
   cout << "</head>\n";
   cout << "<body>\n";
   char* ip = getenv("REMOTE_ADDR");
   cout << "<h2>Your ip is " << ip << "</h2>\n";
   cout << "</body>\n";
   cout << "</html>\n";
   
   return 0;
}