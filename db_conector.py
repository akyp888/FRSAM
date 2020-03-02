import mysql.connector
import datetime
from face_recognition_main import usn_frp

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="students_db"
)


mycursor1 = mydb.cursor(buffered=True)
mycursor2 = mydb.cursor(prepared=True)



mycursor1.execute("select usn from students") 
rows = mycursor1.rowcount
usn_db = []
for _ in range(rows):
    usn_db.append(mycursor1.fetchone()[0])

print("number of students: ")
print(len(usn_frp))
print("usn of the students:")
for n in usn_frp:
    print(n)

    
period = int(input('enter period number'))
if input("please verify the above details and press y yes , n no")=='y':
    

    insert_query = '''insert into attendance(usn,all_dates,period_no,attendance_status) values(%s,%s,%s,%s)'''
    date = "{:%d-%m-%Y}".format(datetime.datetime.today())
    for a in usn_db:
        if a in usn_frp:
            mycursor2.execute(insert_query,(a,date,period,"present"))
        else:
            mycursor2.execute(insert_query,(a,date,period,"absent"))
        mydb.commit()
    print("database updated successfully")
else:
    print("terminated without saving")
