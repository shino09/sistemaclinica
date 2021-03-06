<div class="navegacion">
  <div class="center">
    <?=$this->layout->getNav();?>
  </div>
</div>
<div class="center agregar-control">
  <h2>Agregar nuevo control operativo</h2>
  <div class="grupos">
    <div class="info">
      <div>Centro médico: <strong>Centro médico</strong></div>
      <div>Unidad: <strong>Servicio 2</strong></div>
      <div>Fecha: <strong>21-01-1018</strong></div>
    </div>
    <div class="info">
      <div>Hora: <strong>18:30 hrs</strong></div>
      <div>Nombre: <strong>José Vásquez M.</strong></div>
      <div>Rut: <strong>13.568.980-5</strong></div>
    </div>
  </div>
  <form>
    <div class="cont">
      <div>
        <label>Cupos:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>Tipos de control:</label>
        <select>
          <option></option>
        </select>
      </div>
    </div>
    <div class="cont">
      <div>
        <label>Tipo de soporte:</label>
        <select>
          <option></option>
        </select>
      </div>
    </div>
    <div class="cont">
      <div>
        <label>Equipos en uso:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>Soporte adicional:</label>
        <input type="checkbox" />
        iNOMAX
        <input type="checkbox" />
        ECMO </div>
    </div>
    <div class="cont">
      <div>
        <label>Insumo:</label>
        <select>
          <option>Circuito</option>
        </select>
      </div>
      <div>
        <select>
          <option>Filtro</option>
        </select>
      </div>
    </div>
    <div class="cont">
      <div>
        <label>Vía aérea:</label>
        <select>
          <option>Seleccione Tipo</option>
        </select>
      </div>
    </div>
    <div class="cont">
      <div style="width: 40px;">
        <label>Cuff:</label>
        <input type="radio" />
        si </div>
      <div>
        <select>
          <option>Volumen</option>
        </select>
      </div>
      <div>
        <select>
          <option>Presión</option>
        </select>
      </div>
      <div>
        <input type="radio" />
        No </div>
    </div>
    <div class="cont">
      <div>
        <label>Fecha</label>
        <input type="text" id="datepicker" />
        <i class="fa fa-calendar"></i> </div>
      <div>
        <label>Hora</label>
        <input type="text" id="datepicker" />
        <i class="fa fa-clock-o"></i> </div>
    </div>
    <div class="cont-sup">
      <div>
        <label>Frecuencia cardiaca</label>
        <input type="text" />
      </div>
      <div>
        <label>Frecuencia Respiratoria</label>
        <input type="text" />
      </div>
      <div>
        <label>Presión Arterial:</label>
        <span>
        <div>
          <label>Sistólica</label>
          <input type="text" />
        </div>
        <div>
          <label>Diastólica</label>
          <input type="text" />
        </div>
        <div>
          <label>Presión arterial media</label>
          <input type="text" />
        </div>
        </span> </div>
    </div>
    <div class="cont-sup">
      <div>
        <label>Saturación:</label>
        <span>
        <div>
          <label>Preductal</label>
          <input type="text" />
        </div>
        <div>
          <label>Postductal</label>
          <input type="text" />
        </div>
        </span> </div>
    </div>
    <div class="cont">
      <div>
        <input type="radio" />
        Modo ventilatorio PC </div>
      <div>
        <select>
          <option>CMV</option>
        </select>
      </div>
      <div>
        <input type="radio" />
        Modo ventilatorio VC </div>
      <div>
        <select>
          <option>CMV</option>
        </select>
      </div>
      <div>
        <input type="radio" />
        Modos duales </div>
      <div>
        <select>
          <option>VCRP</option>
        </select>
      </div>
      <div>
        <input type="radio" />
        Otros </div>
      <div>
        <input type="text" />
      </div>
    </div>
    <div class="cont3">
      <div>
        <label>PIM/PMAX</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>Presión plateau</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>PEEP:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>Presión media</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>Presión de soporte</label>
        <select>
          <option></option>
        </select>
      </div>
      <div class="sub-contenedor">
        <label>Alarma de presión</label>
        <input type="text" placeholder="Alta" />
      </div>
      <div class="sub-contenedor">
        <input type="text" placeholder="Baja" />
      </div>
      <div>
        <label>VC ins:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>VC Esp:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>V min:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div class="sub-contenedor">
        <label>Alarma de volumen corriente:</label>
        <input type="text" placeholder="Alta" />
      </div>
      <div class="sub-contenedor">
        <input type="text" placeholder="Baja" />
      </div>
      <div></div>
      <div class="sub-contenedor">
        <label>Alarma de volumen Minuto:</label>
        <input type="text" placeholder="Alta" />
      </div>
      <div class="sub-contenedor">
        <input type="text" placeholder="Baja" />
      </div>
      <div>
        <label>FR VM:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>FR total:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>Tiempo respiratorio:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div>
        <label>Relación I;E:</label>
        <input type="text" />
      </div>
      <div>
        <label>Flujo respiratorio:</label>
        <input type="text" />
      </div>
      <div>
        <label>Flujo espiatorio:</label>
        <input type="text" />
      </div>
      <div class="sub-contenedor">
        <label>Humidificación:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div class="sub-contenedor">
        <label>Temperatura:</label>
        <select>
          <option></option>
        </select>
      </div>
      <div class="sub-contenedor">
        <label>Nivel:</label>
        <select>
          <option></option>
        </select>
      </div>
    </div>
    <div class="cont3">
      <div>
        <label>Cambio Matraz/Llenado de cámara humidificadora</label>
        <select>
          <option></option>
        </select>
      </div>
    </div>
    <div class="columnas">
      <p>Exámenes de laboratorio</p>
      <div class="col">
        <h3>Gases Arteriales</h3>
        <div>
          <label>pH:</label>
          <input type="text" />
        </div>
        <div>
          <label>Pa02:</label>
          <input type="text" />
        </div>
        <div>
          <label>PaO2:</label>
          <input type="text" />
        </div>
        <div>
          <label>HCO3:</label>
          <input type="text" />
        </div>
        <div>
          <label>BE:</label>
          <input type="text" />
        </div>
        <div>
          <label>FiO2 GSA:</label>
          <input type="text" />
        </div>
        <div>
          <label>Pa/Fi:</label>
          <input type="text" />
        </div>
        <div>
          <label>lox:</label>
          <input type="text" />
        </div>
        <div>
          <label>etCO2:</label>
          <input type="text" />
        </div>
      </div>
      <hr />
      <div class="col">
        <h3>Sangre</h3>
        <div>
          <label>HTC:</label>
          <input type="text" />
        </div>
        <div>
          <label>Hb:</label>
          <input type="text" />
        </div>
        <div>
          <label>Gb:</label>
          <input type="text" />
        </div>
        <div>
          <label>Plaquetas:</label>
          <input type="text" />
        </div>
      </div>
      <hr />
      <div class="col">
        <h3>Electrolitos de sangre</h3>
        <div>
          <label>Na:</label>
          <input type="text" />
        </div>
        <div>
          <label>k:</label>
          <input type="text" />
        </div>
        <div>
          <label>CI:</label>
          <input type="text" />
        </div>
        <div>
          <label>Ca:</label>
          <input type="text" />
        </div>
        <div>
          <label>P:</label>
          <input type="text" />
        </div>
        <div>
          <h3>Inflamatorios</h3>
        </div>
        <div>
          <label>PCR:</label>
          <input type="text" />
        </div>
      </div>
    </div>
    <div class="cont3">
      <p>Función Pulmonar</p>
      <div>
        <label>Distensibilidad dinámica:</label>
        <input type="text" />
      </div>
      <div>
        <label>Distensibilidad estática:</label>
        <input type="text" />
      </div>
      <div>
        <label>Resistencia:</label>
        <input type="text" />
      </div>
      <div>
        <label>Cte. Tpo:</label>
        <input type="text" />
      </div>
      <div>
        <label>C20/C:</label>
        <input type="text" />
      </div>
      <div>
        <label>P0,1:</label>
        <input type="text" />
      </div>
    </div>
    <div class="cont3">
      <p>VAFO</p>
      <div>
        <label>Frecuencia</label>
        <input type="text" />
      </div>
      <div>
        <label>Amplitud:</label>
        <input type="text" />
      </div>
      <div>
        <label>Delta P:</label>
        <input type="text" />
      </div>
      <div>
        <label>Flujo base</label>
        <input type="text" />
      </div>
      <div class="sub-contenedor">
        <label>Alarmas:</label>
        <input type="text" placeholder="Alta" />
      </div>
      <div class="sub-contenedor">
        <label>Alarmas:</label>
        <input type="text" placeholder="Baja" />
      </div>
    </div>
    <div class="cont3">
      <div>
        <label>Respaldo</label>
        <select>
          <option>Bolsa Autoinflable</option>
        </select>
      </div>
    </div>
    <div class="cont3">
      <div class="sub-contenedor">
        <label>Cambio circuito:</label>
        <select>
          <option>Si</option>
        </select>
      </div>
      <div class="sub-contenedor">
        <label>Fecha de cambio:</label>
        <input type="text" placeholder="Baja" id="datepicker_2" />
        <i class="fa fa-calendar"></i> </div>
      <div>
        <label>Aseo diario</label>
        <select>
          <option>Si</option>
        </select>
      </div>
      <div>
        <label>Kinesiologo responsable:</label>
        <select>
          <option>Daniel Cornejo</option>
        </select>
      </div>
    </div>
    <div class="cont3">
      <p>iNO</p>
      <div>
        <label>NO</label>
        <input type="text" />
      </div>
      <div>
        <label>NO2</label>
        <input type="text" />
      </div>
      <div>
        <label>FiO2</label>
        <input type="text" />
      </div>
      <div>
        <label>Carga</label>
        <input type="text" />
      </div>
      <div>
        <label>iNO meter</label>
        <input type="text" />
      </div>
      <div>
        <label>Calibración baja</label>
        <input type="text" />
      </div>
      <div>
        <label>Calibración alta</label>
        <input type="text" />
      </div>
      <div>
        <label>Calibración</label>
        <input type="text" />
      </div>
      <div>
        <label>Desinfección</label>
        <input type="text" />
      </div>
      <div>
        <label>PSI actuales</label>
        <input type="text" />
      </div>
      <div class="sub-contenedor">
        <label>Nro de serie balon:</label>
        <input type="text" />
      </div>
      <div class="sub-contenedor">
        <label>Consumo últimas 24 hrs:</label>
        <input type="text" />
      </div>
    </div>
    <div class="cont3">
      <p>ECMO</p>
      <div>
        <label>FiO2 ECMO / Volumen CUFF</label>
        <input type="text" />
      </div>
      <div>
        <label>Flujo aire / O2 / Presión CUFF</label>
        <input type="text" />
      </div>
      <div>
        <label>Flujo CO2 / N2</label>
        <input type="text" />
      </div>
      <div>
        <label>Carga CO2 / N2</label>
        <input type="text" />
      </div>
    </div>
    <div class="fondo-botones">
      <div class="btn-group">
        <button>Guardar control médico</button>
      </div>
    </div>
  </form>
</div>
