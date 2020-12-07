<form  action="#" id="form" class="form-horizontal" method="post">
             <label for="primer_nombre">Primer Nombre:</label>
          <input type="text" tabindex="1" id="pilot_firstname" title="primer_nombre" name="pilot_firstname" placeholder="Primer Nombre " />
             <label for="pilot_lastname">Apellido:</label>
          <input type="text" tabindex="1" id="pilot_lastname" title="apellido" name="pilot_lastname" placeholder="Apellido" />
          <label for="pilot_phone">Telefono:</label>
          <input type="text" tabindex="1" id="pilot_phone" title=tTelefono" name="pilot_phone" placeholder="Telefono" />
          <label for=pilot_cellphone">Celular:</label>
          <input type="text" tabindex="2" id="pilot_cellphone" title="celular" name="email" placeholder="celular" />
          <label for="pilot_email">Email:</label>
          <input type="text" tabindex="3" id="pilot_email" title="email" name="pilot_email" placeholder="Email" />
            <label for="pilot_notes">Comentario:</label>
          <input type="text" tabindex="3" id="pilot_notes" title="comentario" name="pilot_notes" placeholder="Comentario" />
          <label for="pilot_contact_type_id">pilot_contact_type_id:</label>
          <input type="radio" name="pilot_contact_type_id" id="pilot_contact_type_id" value="1" checked>1-Electronico
          <input type="radio" name="pilot_contact_type_id" id="pilot_contact_type_id" value="2">2-Telefonico
          <input type="radio" name="pilot_contact_type_id" id="pilot_contact_type_id" value="3">3-Entrevista

          <label for="pilot_business_type_id">pilot_business_type_id:</label>
          <input type="radio" name="pilot_business_type_id" id="pilot_business_type_id" value="1" checked>1-Convencional
          <input type="radio" name="pilot_business_type_id" id="pilot_business_type_id" value="2">2-Usado
          <input type="radio" name="pilot_business_type_id" id="pilot_business_type_id" value="3">3-Plan de Ahorro
            <div>
                    <button type="submit" id="form" class="btn btn-success">Filtrar</button>
                </div>

        
      </form>