
<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 15px;
    text-align: left;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #294253;
  color: white;
}
#user{
  text-transform: uppercase;
  color: #294253;
}
tr:hover {background-color: #f5f5f5;}
</style>
</head>
<body>
<p>Hello Sir/Ma'am,</p>

<p>This Mail Send By <b id="user">{{$user['fname'].' '.$user['lname']}}</b></p>
<p>Here Futher Detail:-</p>
<table id="customers">
  <thead>
     <tr>
       <th>First Name</th>
       <th>Last Name</th>
       <th>Email Address</th>
       <th>Mobile Number</th>     
       <th>Address</th>
       <th>Message</th>
  </tr>
</thead>
<tbody>
  <tr>
          <td>{{$user['fname']}}</td>
          <td>{{$user['lname']}}</td>
          <td>{{$user['cemail']}}</td>  
          <td>{{$user['mobile_no']}}</td>      
          <td>{{$user['address']}}</td>
          <td>{{$user['message']}}</td>
  </tr>
</tbody>
</table>
<p>Regard</p>
<p>adlaw</p>
</body>
</html>