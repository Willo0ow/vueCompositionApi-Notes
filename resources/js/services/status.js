import axios from "axios";

const getStatuses = async () => {
    const res = await axios.get(`/api/status`);
    return res.data
    .map((status)=>{
      const statusCopy = {...status};
      statusCopy.title = statusCopy.label;
      statusCopy.value = statusCopy.id;
      return statusCopy;
    });
  }

export {getStatuses}