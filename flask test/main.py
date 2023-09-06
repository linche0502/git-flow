from flask import Flask, render_template, request, redirect
import pymysql

app= Flask(__name__)



createTableText= '''CREATE TABLE IF NOT EXISTS office(
        ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        companyName VARCHAR(100),
        applyName VARCHAR(100),
        roomName VARCHAR(100),
        day VARCHAR(100),
        time VARCHAR(100)
    );'''

def insertData(companyName,applyName,roomName,day,time):
    conn= pymysql.connect(host= "localhost", port= 3306, user= "root", passwd= "01234567", charset= "utf8", db= "testdb")
    with conn.cursor() as cursor:
        cursor.execute(createTableText)
        cursor.execute(f"INSERT INTO office (companyName,applyName,roomName,day,time) VALUES ('{companyName}','{applyName}','{roomName}','{day}','{time}');")
        conn.commit()
    conn.close()
def getData(text=''):
    conn= pymysql.connect(host= "localhost", port= 3306, user= "root", passwd= "01234567", charset= "utf8", db= "testdb")
    with conn.cursor() as cursor:
        cursor.execute(createTableText)
        cursor.execute(f"SELECT * FROM office;")
        data= cursor.fetchall()
        conn.commit()
    conn.close()
    return data

@app.route('/', methods= ['GET','POST'])
def main():
    days= ['Sun','Mon','Tue','Wen','Thu','Fri','Sat']
    times= [f'{i}:00' for i in range(8,18)]
    roomNames= ['A','B','C']
    cols= ['companyName', 'applyName', 'roomName', 'day', 'time']
    
    # rooms= [(ID1,companyName1,applyName1,roomName1,day1,time1), (ID2,companyName2,applyName2,roomName2,day2,time2), ...]
    rooms= getData()
    # reserves= {'wed':{'11:00': 'A':Office1, 'B':null, ...}, ...}
    reserves= {}
    for room in rooms:
        id,companyName,applyName,roomName,day,time= room
        if day not in reserves:
                reserves[day]= {}
        if time not in reserves[day]:
            reserves[day][time]= {}
        if roomName not in reserves[day][time]:
            reserves[day][time][roomName]= {}
        reserves[day][time][roomName]= companyName
    
    errorMsg= ''
    
    if request.method == "POST":
        companyName,applyName,roomName,day,time= [request.form.get(col) for col in cols]
        if reserves.get(day,{}).get(time,{}).get(roomName,'') == '':
            insertData(companyName,applyName,roomName,day,time)
            return redirect('/')
        else:
            errorMsg= '已存在'
    
    return render_template('base.html', times=times, roomNames=roomNames, rooms=reserves, cols=cols, errorMsg=errorMsg)


@app.route('/manage')
def manage():
    
    return



if __name__ == "__main__":
    app.run(port=8080 ,debug=True)