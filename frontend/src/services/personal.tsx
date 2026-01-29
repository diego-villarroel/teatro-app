export const getPersonal = async (id: number) => {
  try {
    const response = await fetch('/data/example.json');
    const data = await response.json();
    if (data.personal && data.personal.some((element: any) => element.teatro_id === id)) {
      return data.personal.filter((element: any) => element.teatro_id === id);

    } else {
      return [];
    }
  } catch (error) {
    console.error('Error fetching personal:', error);
    return [];
  }
}

export const getHorarios = async () => {
  try {
    const response = await fetch('/data/example.json');
    const data = await response.json();
    if (data.horarios){
      return data.horarios;
    } else {
      return [];
    }
  } catch (error) {
    console.error('Error fetching horarios:', error);
    return [];
  }
}

export const getCargos = async () => {
  try {
    const response = await fetch('/data/example.json');
    const data = await response.json();
    if (data.cargos) {
      return data.cargos;
    } else {
      return [];
    }
  } catch (error) {
    console.log('Error fetching cargos:', error);
    return [];
  }
}

export const getEstadoPersonal = async () => {
  try {
    const response = await fetch ('/data/example.json');
    const data = await response.json();
    if (data.estado_personal) {
      return data.estado_personal;
    }
  } catch (error) {
    console.error('Error fetching estados:', error);
    return [];
  }
}