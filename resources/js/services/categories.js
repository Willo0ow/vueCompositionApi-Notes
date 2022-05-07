import axios from "axios";

const getCategories = async () => {
    const res = await axios.get("/api/category");
   return  res.data
    .map((cat)=>{
      const catCopy = {...cat};
      catCopy.text = catCopy.name;
      catCopy.value = catCopy.id;
      return catCopy;
    });
  }

export {getCategories}