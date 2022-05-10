import axios from "axios";

const getNotes = async ()=>{
    const res = await axios.get("/api/note");
    return res.data;
}

const getNote = async (id)=>{
    const res = await axios.get(`/api/note/${id}`);
    return res.data;
}

const deleteNote = async (noteId)=>{
    await axios.delete(`/api/note/${noteId}`);
}

export {getNotes, getNote, deleteNote}