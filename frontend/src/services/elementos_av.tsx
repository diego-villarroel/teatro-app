interface ElementoAV {
  id: number;
  teatro_id: number;
  categoria_id: number;
  marca: string;
  modelo: string;
  estado: number;
  fecha_compra: string;
  fecha_mod: string;
}

export const getElementosAV = async (id: number, sala: number) => {
  try {    
    const response = await fetch('/data/example.json');
    const data = await response.json();    
    if (data.elementos_audiovisuales) {
      let filter_data = data.elementos_audiovisuales.filter((elem: ElementoAV) => elem.teatro_id == id);
      let elem = [];      
      let aux;
      let cantidad = 0;
      for (let i = 0; i < filter_data.length; i++) {
        if (i > 0 && filter_data[i-1].categoria_id == filter_data[i].categoria_id && filter_data[i-1].marca == filter_data[i].marca && filter_data[i-1].modelo == filter_data[i].modelo && filter_data[i-1].estado == filter_data[i].estado) {
          cantidad ++;
        } else {
          if (aux) {
            aux.cantidad = cantidad;
            elem.push(aux);
          }
          cantidad = 1;
          aux = {...filter_data[i]};
        }
      }
      if (aux) {
        aux.cantidad = cantidad;
        elem.push(aux);
      }
      return elem;
    } else {
      return [];
    }
  } catch (error) {
    console.error('Error fetching elementos audiovisuales:', error);
    return [];
  }
}

export const getCategoryElem = async () => {
  try {
    const response = await fetch('/data/example.json');
    const data = await response.json();
    return data.categorias;
  } catch (error){
    console.error('Error fetching elementos audiovisuales:', error);
    return [];
  }
}