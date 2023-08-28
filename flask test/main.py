from flask import Flask, render_template, request, redirect

app= Flask(__name__)


class Office():
    roomNames= ['A','B','C']
    times= [f'{i}:00' for i in range(8,18)]
    def __init__(self, companyName, applyName, roomName, date, time):
        self.companyName= companyName
        self.applyName= applyName
        self.roomName= roomName
        self.day= date
        self.time= time
rooms= {}

@app.route('/', methods= ['GET','POST'])
def main():
    # return 'hello world'
    # rooms= {'wed':{'11:00': 'A':Office1, 'B':null, ...}, ...}
    reserves= {day:{time:{roomName:rooms[day][time][roomName].companyName for roomName in rooms[day][time]} for time in rooms[day]} for day in rooms}
    errorMsg= ''
    
    if request.method == "POST":
        day, time, roomName= [request.form.get(col) for col in ['day', 'time', 'roomName']]
        if reserves.get(day,{}).get(time,{}).get(roomName,'') == '':
            if day not in rooms:
                rooms[day]= {}
            if time not in rooms[day]:
                rooms[day][time]= {}
            if roomName not in rooms[day][time]:
                rooms[day][time][roomName]= {}
            rooms[day][time][roomName]= Office(
                request.form.get('companyName',''),
                request.form.get('applyName',''),
                roomName, day, time
                )
            return redirect('/')
        else:
            errorMsg= '已存在'
    
    times= Office.times
    roomNames= Office.roomNames
    cols= ['companyName', 'applyName', 'roomName', 'day', 'time']
    
    return render_template('base.html', times=times, roomNames=roomNames, rooms=reserves, cols=cols, errorMsg=errorMsg)


@app.route('/manage')
def manage():
    
    return



if __name__ == "__main__":
    app.run(port=8080 ,debug=True)