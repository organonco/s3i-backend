import{_ as s}from"./MainLayout-f8f94285.js";import{_ as n}from"./DataTable-f1cdf25f.js";import{C as l}from"./CreateButton-bbeeb758.js";import{C as _}from"./CenterSheet-4d0efea4.js";import{r as i,o as c,f as d,w as t,a as e}from"./app-2855b29f.js";import"./ConfirmationDialog-3250e277.js";const m={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"الاسم",align:"start",key:"name"}]}}},w=Object.assign(m,{__name:"Index",props:{education_levels:Array},setup(r){return(a,u)=>{const o=i("v-row");return c(),d(s,{title:"المستويات الدراسية"},{default:t(()=>[e(l,{link:a.route("education_level.create")},null,8,["link"]),e(_,{cols:"12"},{default:t(()=>[e(o,{class:"pt-5"},{default:t(()=>[e(n,{headers:a.headers,data:r.education_levels.data,actions_route:"education_level"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{w as default};