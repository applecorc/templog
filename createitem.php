<!DOCTYPE html>
<html>
 <head>
  <title>Item Creation</title>
 </head>
 
 <body>
  <form action="temps.php">
   <p>
    Item name: <input type="text" name="Name">
   </p>
   
   <p>
    Storage: 
    <select name="Temp">
     <option value="Hot">Hot Held</option>
     <option value="Cold">Refrigerated</option>
     <option value="Frozen">Frozen</option>
    </select>
   </p>
   
   <p>
    Station: 
    <select name="Station">
     <option value="1">1849</option>
    </select>
   </p>
   
   <p>
    Item Added By: 
    <input type="text" name="AddedBy">
   </p>
   
   <p>
    <input type="submit">
   </p>
  </form>
 </body>

</html>