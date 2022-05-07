import axios from "axios";

const getCategories = async () => {
    const res = await axios.get("/api/category");
   return  res.data
    .map((cat)=>{
      const catCopy = {...cat};
      catCopy.title = catCopy.name;
      catCopy.value = catCopy.id;
      return catCopy;
    });
  }

export {getCategories}