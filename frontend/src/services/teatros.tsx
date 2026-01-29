export const getTeatros = async () => {
  try {
    const response = await fetch('/data/example.json');
    const data = await response.json();
    if (data.teatros) {
      let teatros = data.teatros;
      
      for (const teatro of teatros) {
        teatro.mics = data.elementos_audiovisuales.filter((element: any) => element.teatro_id === teatro.id && element.categoria_id === 1).length;
        teatro.consolas = data.elementos_audiovisuales.filter((element: any) => element.teatro_id === teatro.id && element.categoria_id === 2).length;
        teatro.cajas = data.elementos_audiovisuales.filter((element: any) => element.teatro_id === teatro.id && element.categoria_id === 3).length;
        teatro.otros = data.elementos_audiovisuales.filter((element: any) => element.teatro_id === teatro.id && element.categoria_id === 4).length;
        teatro.personal = data.personal.filter((element: any) => element.teatro_id === teatro.id).length;
      }
      return teatros;
    } else {
      return [];
    }
  } catch (error) {
    console.error('Error fetching teatro data:', error);
    return [];
  }
}

export const getTeatro = async (id_teatro: any) => {
  
  try {
    const response = await fetch ('/data/example.json');
    const data = await response.json();
    for (let teatro of data.teatros) {
      if (teatro.id == id_teatro) {
        return teatro;
      }
    }
  } catch (error) {
    console.error('Error fetching teatro data:', error);
    return [];

  }
}

export const getSalas = async (id_teatro: any) => {
  try {
    const response = await fetch('/data/example.json');
    const data = await response.json();
    if (data.espacios) {   
      console.log(data.espacios.filter((espacio: any) => espacio.teatro_id == id_teatro));
         
      return data.espacios.filter((espacio: any) => espacio.teatro_id == id_teatro);
    } else {
      return [];
    }
  } catch (error) {
    console.error('Error fetching teatro data:', error);
    return [];
  }
}