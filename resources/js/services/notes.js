import axios from "axios";

const getNotes = async ()=>{
    const res = await axios.get("/api/note");
    return res.data;
}

export {getNotes}