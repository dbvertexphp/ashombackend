<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>admin</title>
 </head>
 <body>
     <form method="post" enctype='multipart/form-data' action="postdata">
         <select name="companyid">
             <?php
             $companies = $this->db->get("companies")->result(); 
             foreach($companies as $company){
             ?>
             <option src="<?=$company->id?>"><?=$company->Company_Name?></option>
             <?php } ?>
         </select><br><br>
         <select name="timeperiod">
             <option value="q">Quaterly</option>
             <option value="h">Half Yearly</option>
             <option value="f">Final</option>
         </select>
         <br><br>
         <input type="file" id="files" name="files" multiple><br><br>
     </form>
 </body>
 </html>