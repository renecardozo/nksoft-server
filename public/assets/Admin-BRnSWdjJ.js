import{r as n,u as b,j as e,C as y,a as i,b as r,c as A,d as I,e as S,f as k,g as x,h as m,i as u,k as w,l as h,m as E,n as L,o as j,p as z,q as B}from"./index-Caj9Gai4.js";const F=()=>{const[o,C]=n.useState("barthg.simpson@mail.ogt"),[l,p]=n.useState("1234567"),[g,f]=n.useState(!1),[c,t]=n.useState(!1),d=b(),v=s=>{s.preventDefault(),t(!0),z(o,l).then(a=>{const{data:N}=a;N.role.name==="SuperAdmin"?(localStorage.setItem("user_data",JSON.stringify(a.data)),B({email:o},"Login Admin",0),d("/administracion/calendario")):f(!0),t(!1)}).catch(a=>{console.error(a),t(!1)})};return e.jsx("div",{id:"background-div",className:"bg-body-tertiary min-vh-100 d-flex flex-row align-items-center",children:e.jsx(y,{children:e.jsx(i,{className:"justify-content-center",children:e.jsx(r,{md:8,children:e.jsx(A,{children:e.jsx(I,{className:"p-4",children:e.jsx(S,{children:e.jsxs(k,{children:[e.jsx("h1",{children:"Admin Login"}),e.jsx("p",{className:"text-body-secondary",children:"Inicie sesion con su cuenta de administrador"}),e.jsxs(x,{className:"mb-3",children:[e.jsx(m,{children:e.jsx(u,{icon:w})}),e.jsx(h,{placeholder:"Correo Electronico",autoComplete:"Correo Electronico",value:o,onChange:s=>C(s.target.value)})]}),e.jsxs(x,{className:"mb-4",children:[e.jsx(m,{children:e.jsx(u,{icon:E})}),e.jsx(h,{type:"password",placeholder:"Contraseña",autoComplete:"Contraseña",value:l,onChange:s=>p(s.target.value)})]}),e.jsx(i,{children:g&&e.jsx(r,{xs:12,children:e.jsx(L,{color:"danger",children:"Acceso no autorizado"})})}),e.jsxs(i,{children:[e.jsx(r,{xs:6,children:e.jsx(j,{color:"primary",className:"px-4",onClick:s=>v(s),disabled:c,children:"Ingresar"})}),e.jsx(r,{xs:6,className:"text-end",children:e.jsx(j,{color:"default",className:"px-4",onClick:s=>d("/login"),disabled:c,children:"Volver"})})]})]})})})})})})})})};export{F as default};
