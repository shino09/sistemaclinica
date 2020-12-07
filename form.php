<html>
     <head>
          <meta http-equiv="Content-type" content="text/html;charset=utf-8">

               
          <style type="text/css">
               H1 {
                    text-align:justify;
					font-size: 18px;
				   font-family: Arial, "Times New Roman", Times, serif;
               }
			   
			   body, td, input {
				   font-size: 16px;
				   font-family: Arial, "Times New Roman", Times, serif;
				   padding: 5px;
				   
			   }
			   div {
				   font-size: 14px;
				   font-family: "Times New Roman", Times, serif;
				   color: blue;
			   }
          </style>

     </head>


     <body>
		<form method="POST" action="sendToPilot.php">
          <center>
               <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                         <td>
                              <table width="600" cellpadding="5" cellspacing="0">
                                   <tr>
                                        <td colspan="3" align="left" valign="top">
                                             <h1>
                                                  <b>PAGINA DE EJEMPLO INTEGRACION PILOT VIA API 1.0 LLAMADA API REST</b>
                                             </h1>
                                            
                                        </td>
                                   </tr>

                                   <tr>
                                        <td align="right" valign="top">
                                             <label for="pilot_firstname">pilot_firstname:</label>
                                        </td>
                                        <td align="left" valign="top">
                                             <input type="text" value="Jhon" name="pilot_firstname" id="pilot_firstname" style="width:300px;" maxlength="50" />
                                        </td>
                                   </tr>
                                   <tr>
                                        <td align="right" valign="top">
                                             <label for="pilot_lastname">pilot_lastname:</label>
                                        </td>
                                        <td align="left" valign="top">
                                             <input type="text" value="Doe" name="pilot_lastname" id="pilot_lastname" style="width:300px;" maxlength="50" />
                                        </td>
                                   </tr>
                                   <tr>
                                        <td align="right" valign="top">
                                             <label for="pilot_phone">pilot_phone:</label>
                                        </td>
                                        <td align="left" valign="top">
                                             <input type="text" value="1147895600" name="pilot_phone" id="pilot_phone" style="width:300px;" maxlength="100" />
                                        </td>
                                   </tr>
                                   <tr>
                                        <td align="right" valign="top">
                                             <label for="pilot_cellphone">pilot_cellphone:</label>
                                        </td>
                                        <td align="left" valign="top">
                                             <input type="text" value="1133445566" name="pilot_cellphone" id="pilot_cellphone" style="width:300px;" maxlength="100" />
                                        </td>
                                   </tr>
                                   <tr>
                                        <td align="right" valign="top">
                                             <label for="pilot_email">pilot_email:</label>
                                        </td>
                                        <td align="left" valign="top">
                                             <input type="text" value="jhondoe@mail.com" name="pilot_email" id="pilot_email" style="width:300px;" maxlength="250" />
                                        </td>
                                   </tr>
                                   <tr>
                                        <td align="right" valign="top">
                                             <label for="pilot_notes">pilot_notes:</label>
                                        </td>
                                        <td align="left" valign="top">
                                             <textarea rows="5" cols="45" name="pilot_notes" id="pilot_notes" maxlength="1000">Esto es una prueba</textarea>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td align="right" valign="top">
                                             <label for="pilot_contact_type_id">pilot_contact_type_id:</label>
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="radio" name="pilot_contact_type_id" id="pilot_contact_type_id" value="1" checked>1-Electronico
											<br>
											<input type="radio" name="pilot_contact_type_id" id="pilot_contact_type_id" value="2">2-Telefonico
											<br>
											<input type="radio" name="pilot_contact_type_id" id="pilot_contact_type_id" value="3">3-Entrevista
                                        </td>
                                   </tr>
                                   <tr>
                                        <td align="right" valign="top">
                                             <label for="pilot_business_type_id">pilot_business_type_id:</label>
                                        </td>
                                        <td align="left" valign="top">
                                            <input type="radio" name="pilot_business_type_id" id="pilot_business_type_id" value="1" checked>1-Convencional
											<br>
											<input type="radio" name="pilot_business_type_id" id="pilot_business_type_id" value="2">2-Usado
											<br>
											<input type="radio" name="pilot_business_type_id" id="pilot_business_type_id" value="3">3-Plan de Ahorro
                                        </td>
                                   </tr>
                                  
                                   <tr>
                                        <td colspan="3">
                                             <center><input type="submit" value="Enviar" /></center>
                                        </td>
                                   </tr>
                                   
                                   <tr>
                                        <td colspan="3" align="left" valign="top">
                                             <p><b>PILOT TEAM</b></p>
                                        </td>
                                   </tr>
                              </table>
                         </td>
                    </tr>
                    <tr>
                         <td>
                              <table width="600" cellpadding="20" cellspacing="0" id="">
                                   <tr>
                                        <td align="left" valign="top" id="footer">
                                             <p>
                                                  Copyright (C) 2013. Powered by <a href="http://www.pilotsolution.com.ar">Pilot Solution</a>. Todos los derechos reservados.
                                             </p>
                                        </td>
                                   </tr>
                              </table>
                         </td>
                    </tr>
               </table>
          </center><span style="padding: 0px;"></span>
		</form>
     </body>
</html>