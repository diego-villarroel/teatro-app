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

export const getElementosAV = async (id: number) => {
  try {    
    const response = await fetch('/data/example.json');
    const data = await response.json();
    if (data.elementos_audiovisuales) {
      return data.elementos_audiovisuales.filter((elem: ElementoAV) => elem.teatro_id == id);
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