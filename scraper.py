import sys
import requests
from bs4 import BeautifulSoup
from googlesearch import search

# Read input parameters
url = sys.argv[1]
dork = sys.argv[2]
query = sys.argv[3]

# Google search using selected dork and query
search_url = f"https://www.google.com/search?q={dork}:{url}+{query}"
response = requests.get(search_url)
soup = BeautifulSoup(response.content, 'html.parser')

# Scrape website content
content = soup.find_all('div', {'class': 'g'})
text = ''
for c in content:
    link = c.find('a')
    if link:
        link_url = link['href']
        if url in link_url:
            text += c.text

# Print sentiment analysis
print(text)
