import{_ as s}from"./MainLayout-14f73f89.js";import{_ as n}from"./DataTable-3745ae25.js";import{C as _}from"./CenterSheet-c32fda75.js";import{r as l,o as i,f as c,w as e,a as t}from"./app-bdcf9ddf.js";import"./ConfirmationDialog-9b122890.js";const d={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"الاسم",align:"start",key:"name"}]}}},k=Object.assign(d,{__name:"Index",props:{education_levels:Array},setup(a){return(r,m)=>{const o=l("v-row");return i(),c(s,{title:"المستويات الدراسية"},{default:e(()=>[t(_,{cols:"12"},{default:e(()=>[t(o,{class:"pt-5"},{default:e(()=>[t(n,{headers:r.headers,data:a.education_levels.data,actions_route:"education_level",uneditable:""},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{k as default};
