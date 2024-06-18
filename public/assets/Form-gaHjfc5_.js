import{r as x,u as E,X as q,j as s,a as w,b as k,d as O,e as R,f as D,S as c,l as m,o as K,W as p}from"./index-WtevhoQQ.js";import{C as L}from"./CCardHeader-D4DyBJWy.js";import{C as U}from"./CFormSelect-BqpKVJxX.js";function B(){const[g,N]=x.useState([]),F=E(),{id:u}=q(),[o,_]=x.useState({name:"",last_name:"",email:"",ci:"",code_sis:"",phone:"",role_id:""}),l={rules:["required"],errors:[]},[r,f]=x.useState({name:{...l},last_name:{...l},email:{...l},ci:{...l},code_sis:{...l},phone:{...l},role_id:{...l}}),I=async()=>{const t=(await p.get("api/roles")).filter(a=>a.id!==1);N(t)};x.useEffect(()=>{u&&(async()=>{let n=`api/users/${u}`;const t=await p.get(n);_({...o,...t})})(),I()},[]);const S=async(e,n)=>{e.preventDefault(),P(n).then(t=>{(u?p.put(`api/users/${u}`,o):p.post("api/users",o)).then(()=>(F("/users"),!0)).catch(async h=>{const d=await h.response.json(),b={};for(const v of Object.keys(d.error))r[v]&&d.error[v].length>0&&(b[v]={...r[v],errors:d.error[v]});return f({...r,...b}),!1})})},y=(e,n)=>{const t={required:"Este campo es requerido"};let a={...r[e]};if(r[e]){const h=Object.values(t);a={...r[e],errors:r[e].errors.filter(d=>h.includes(d))},r[e].rules&&r[e].rules.length>0&&r[e].rules.includes("required")&&([null,void 0,""].includes(n)?a={...r[e],errors:a.errors.concat(t.required)}:a={...r[e],errors:a.errors.filter(d=>d!==t.required)})}return a},P=async e=>{const n={};for(const a of Object.keys(e))n[a]=y(a,e[a]);return f(n),Object.keys(n).some(a=>n[a].errors&&n[a].errors.length>0)?Promise.reject(!1):Promise.resolve(!0)},j=e=>{/[0-9]/.test(e.key)||e.preventDefault()},C=e=>{/^[a-zA-Z]+$/.test(e.key)||e.preventDefault()},i=e=>{const n=e.target,t=n.value,a=n.name,h=y(a,t);f({...r,[a]:h}),_({...o,[a]:t})};return s.jsx(w,{children:s.jsx(k,{xs:12,children:s.jsxs(O,{className:"mb-4",children:[s.jsx(L,{children:s.jsx("strong",{children:u?"Editar Usuario":"Crear Usuarios"})}),s.jsx(R,{className:"overflow-auto p-3",children:s.jsxs(D,{className:"row g-3 needs-validation",noValidate:!0,onSubmit:e=>S(e,o),children:[s.jsxs("div",{className:"col-6",children:[s.jsx(c,{htmlFor:"name",children:"Nombre"}),s.jsx(m,{type:"text",name:"name",onKeyPress:C,id:"name",invalid:r.name.errors.length>0,feedbackInvalid:r.name.errors[0],value:o.name,onChange:i})]}),s.jsxs("div",{className:"col-6",children:[s.jsx(c,{htmlFor:"last_name",children:"Apellido"}),s.jsx(m,{type:"text",name:"last_name",id:"last_name",onKeyPress:C,invalid:r.last_name.errors.length>0,feedbackInvalid:r.last_name.errors[0],value:o.last_name,onChange:i})]}),s.jsxs("div",{className:"col-6",children:[s.jsx(c,{htmlFor:"email",children:"Email"}),s.jsx(m,{type:"text",name:"email",id:"email",invalid:r.email.errors.length>0,feedbackInvalid:r.email.errors[0],value:o.email,onChange:i})]}),s.jsxs("div",{className:"col-6",children:[s.jsx(c,{htmlFor:"ci",children:"Cedula de Identidad"}),s.jsx(m,{type:"text",name:"ci",id:"ci",onKeyPress:j,maxLength:9,invalid:r.ci.errors.length>0,feedbackInvalid:r.ci.errors[0],value:o.ci,onChange:i})]}),s.jsxs("div",{className:"col-12",children:[s.jsx(c,{htmlFor:"code_sis",children:"Codigo Sis"}),s.jsx(m,{type:"text",onKeyPress:j,maxLength:8,name:"code_sis",id:"code_sis",invalid:r.code_sis.errors.length>0,feedbackInvalid:r.code_sis.errors[0],value:o.code_sis,onChange:i})]}),s.jsxs("div",{className:"col-12",children:[s.jsx(c,{htmlFor:"phone",children:"Telefono"}),s.jsx(m,{type:"text",name:"phone",onKeyPress:e=>j(e),maxLength:8,id:"phone",invalid:r.phone.errors.length>0,feedbackInvalid:r.phone.errors[0],value:o.phone,onChange:i})]}),o.role_id!==1&&s.jsxs("div",{className:"col-12",children:[s.jsx(c,{htmlFor:"role_id",children:"Rol"}),s.jsxs(U,{name:"role_id",invalid:r.role_id.errors.length>0,feedbackInvalid:r.role_id.errors[0],value:o.role_id,onChange:i,children:[s.jsx("option",{value:"",children:"Selecciona un rol"}),g&&g.map(e=>s.jsx("option",{value:e.id,children:e.name},e.id))]})]}),s.jsx(k,{xs:12,children:s.jsx(K,{color:"primary",type:"submit",children:"Continuar"})})]})})]})})})}export{B as default};
