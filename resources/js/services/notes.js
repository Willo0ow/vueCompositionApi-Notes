import axios from "axios";

const getNotes = async ()=>{
    const res = await axios.get("/api/note");
    return res.data;
}

const getNote = async (id)=>{
    const res = await axios.get(`/api/note/${id}`);
    return res.data;
}

export {getNotes, getNote}