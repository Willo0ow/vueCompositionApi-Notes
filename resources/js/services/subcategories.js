import axios from "axios";

const getSubcategories = async ( category) => {
    const res = await axios.get(`/api/categorySubs/${category}`);
    return res.data
    .map((cat)=>{
      const catCopy = {...cat};
      catCopy.title = catCopy.name;
      catCopy.value = catCopy.id;
      return catCopy;
    });
  }

export {getSubcategories}