import{r as i,u as j,j as e,a as f,o as r,b,d as k,e as E,U,W as l}from"./index-Caj9Gai4.js";import{G as g}from"./GenericTable-D1059PiV.js";import{C as M,a as N,b as S,c as v,d as w}from"./CModalTitle-BdNy_a1w.js";import{C as I}from"./CCardHeader-B8t4ttuW.js";function D(){const[o,a]=i.useState(!1),[d,n]=i.useState({}),[c,u]=i.useState([]),m=j(),C=[{id:1,title:"ID",key:"id"},{id:2,title:"Nombre",key:"name"},{id:3,title:"Apellido",key:"last_name"},{id:4,title:"Email",key:"email"},{id:5,title:"Cedula de Identidad",key:"ci"},{id:6,title:"Codigo Sis",key:"code_sis"},{id:7,title:"Rol",key:"role_id",field:s=>s.role.name},{id:8,title:"Telefono",key:"phone"},{id:9,title:"Acciones",key:"actions"}],t=async()=>{const h=await l.get("api/users");u(h)};i.useEffect(()=>{t()},[]);const x=async s=>{m(`/users/${s.id}/edit`)},y=async()=>{await l.delete(`api/users/${d.id}`),t(),a(!1)},p=async s=>{n(s),a(!0)};return e.jsxs(f,{children:[e.jsxs(M,{alignment:"center",visible:o,onClose:()=>a(!1),"aria-labelledby":"VerticallyCenteredExample",children:[e.jsx(N,{children:e.jsx(S,{id:"VerticallyCenteredExample",children:"Eliminar Usuario"})}),e.jsx(v,{children:"Esta seguro de eliminar este usuario "}),e.jsxs(w,{children:[e.jsx(r,{color:"secondary",onClick:()=>a(!1),children:"No"}),e.jsx(r,{color:"primary",onClick:()=>y(),children:"Si"})]})]}),e.jsx(b,{xs:12,children:e.jsxs(k,{className:"mb-4 max-height400",children:[e.jsx(I,{children:e.jsx("strong",{children:"Lista de Usuarios"})}),e.jsxs(E,{className:"overflow-auto p-3",children:[e.jsx(U,{to:"/users/create",className:"btn btn-primary mb-2",children:"Crear Usuario"}),e.jsx(g,{headers:C,list:c,onEdit:s=>x(s),onDelete:s=>p(s)})]})]})})]})}export{D as default};