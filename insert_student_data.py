

data= [
    ['s040','john', '28', '男'],
    ['s041','tania', '18', '女'],
    ['s042','sam', '40', '男']
]
import requests
for row in data:
    sno, sname, sage, ssex= row[0],row[1],row[2],row[3]
    response= requests.get(f'http://127.0.0.1/add_getinsert.php?sno={sno}&sname={sname}&sage={sage}&ssex={ssex}')
    print(response.json())
    # print(response.text)
    

