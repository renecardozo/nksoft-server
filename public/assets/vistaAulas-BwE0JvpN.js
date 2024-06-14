import{X as R,r as o,j as e,C as M,d as O,a as P,b as c,o as h,e as U,B as V,D as X,E as I,F as t,H as _,I as S,i as q,a3 as J}from"./index-Caj9Gai4.js";import{b,c as D,d as T,e as K,f as Q,h as W}from"./servicios-BZT7n_SH.js";import{C as Y}from"./CCardHeader-B8t4ttuW.js";const ea=()=>{const{unidadId:l}=R(),[j,d]=o.useState([]),[k,C]=o.useState(!1),[m,g]=o.useState(""),[v,E]=o.useState(""),[n,y]=o.useState(null),[p,x]=o.useState(""),[N,A]=o.useState(""),[f,w]=o.useState([]);o.useEffect(()=>{(async()=>{try{if(l){const r=await b(l);d(r);const s=await D();w(s)}else console.error("ID de unidad no válido:",l)}catch(r){console.error("Error al obtener las aulas:",r)}})()},[l]),o.useEffect(()=>{(async()=>{try{const s=(await D).data;console.log(s)}catch(r){console.error("Error al obtener las aulas inhabilitadas:",r)}})()},[]);const H=()=>{C(!0)},z=[...j].sort((a,r)=>a.nombreAulas<r.nombreAulas?-1:a.nombreAulas>r.nombreAulas?1:0),B=async()=>{try{const a=parseInt(v);if(isNaN(a)){alert("Por favor, ingrese una capacidad válida.");return}if(a<10||a>600){alert("Por favor, ingrese una capacidad entre 10 y 600.");return}if((await T()).find(u=>u.nombreAulas===m)){alert("El nombre del aula ya está en uso. Por favor, ingrese un nombre diferente.");return}await K({nombreAulas:m,capacidadAulas:a.toString(),unidad_id:l}),alert("Aula agregada correctamente");const i=await b(l);d(i),g(""),E(""),C(!1)}catch(a){console.error("Error al agregar el aula:",a),alert("Error al agregar el aula. Por favor, inténtelo de nuevo.")}},F=a=>{const r=j.find(s=>s.id===a);r?(y(a),x(r.nombreAulas),A(r.capacidadAulas)):console.error("No se encontró el aula con el ID proporcionado:",a)},L=async()=>{try{const a=parseInt(N);if((await T()).find(u=>u.nombreAulas===p&&u.id!==n)){alert("El nombre del aula ya está en uso. Por favor, ingrese un nombre diferente.");return}if(isNaN(a)){alert("Por favor, ingrese una capacidad válida.");return}if(a<10||a>600){alert("Por favor, ingrese una capacidad entre 10 y 600.");return}await Q(n,{nombreAulas:p,capacidadAulas:a.toString()}),alert("Aula actualizada correctamente");const i=await b(l);d(i),y(null),x(""),A("")}catch(a){console.error("Error al actualizar el aula:",a),alert("Error al actualizar el aula. Por favor, inténtelo de nuevo.")}},G=async a=>{try{const r=f.indexOf(a);let s=[...f];r===-1?s.push(a):s.splice(r,1),w(s),await W(a);const i=await b(l);d(i)}catch(r){console.error("Error al habilitar/deshabilitar el aula:",r),alert("Error al habilitar/deshabilitar el aula. Por favor, inténtelo de nuevo.")}};return e.jsx(M,{children:e.jsxs(O,{children:[e.jsx(Y,{children:e.jsxs(P,{children:[e.jsx(c,{children:e.jsx("h3",{children:"Aulas de la unidad"})}),e.jsx(c,{xs:"auto",className:"ml-auto",children:e.jsx(h,{color:"primary",onClick:H,children:"Agregar Aula"})})]})}),e.jsxs(U,{children:[k&&e.jsx("div",{className:"mb-3",children:e.jsxs(P,{children:[e.jsx(c,{children:e.jsx("input",{type:"text",className:"form-control",placeholder:"Nombre del aula",value:m,onChange:a=>g(a.target.value)})}),e.jsx(c,{children:e.jsx("input",{type:"number",className:"form-control",placeholder:"Capacidad del aula",value:v,onChange:a=>E(a.target.value)})}),e.jsx(c,{xs:"auto",children:e.jsx(h,{color:"primary",onClick:B,children:"Guardar"})})]})}),e.jsxs(V,{striped:!0,bordered:!0,responsive:!0,children:[e.jsx(X,{children:e.jsxs(I,{children:[e.jsx(t,{scope:"col",children:"Habilitado"}),e.jsx(t,{scope:"col",children:"Nombre del aula"}),e.jsx(t,{scope:"col",children:"Capacidad (alumnos)"}),e.jsx(t,{scope:"col",children:"Editar"})]})}),e.jsx(_,{children:z.map((a,r)=>e.jsxs(I,{children:[e.jsx(t,{children:e.jsx("input",{type:"checkbox",checked:!f.includes(a.id),onChange:()=>G(a.id)})}),e.jsx(S,{scope:"row",children:n===a.id?e.jsx("input",{type:"text",className:"form-control",value:p,onChange:s=>x(s.target.value)}):a.nombreAulas}),e.jsx(S,{children:n===a.id?e.jsx("input",{type:"number",className:"form-control",value:N,onChange:s=>A(s.target.value)}):a.capacidadAulas}),e.jsx(t,{children:n===a.id?e.jsx(h,{color:"primary",onClick:L,children:"Guardar"}):e.jsx(h,{color:"primary",onClick:()=>F(a.id),children:e.jsx(q,{icon:J})})})]},r))})]})]})]})})};export{ea as default};
