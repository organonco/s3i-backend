import{_ as n}from"./MainLayout-632931fa.js";import{_ as s}from"./DataTable-b2b2623f.js";import{r as i,o as l,f as _,w as a,a as t}from"./app-ae7d8840.js";import{C as m}from"./CreateButton-d20d82cc.js";import{C as c}from"./CenterSheet-09e47e7a.js";import"./ConfirmationDialog-07bffdd8.js";const d={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"الاسم",align:"start",key:"name"}]}}},w=Object.assign(d,{__name:"Index",props:{nationalities:Array},setup(r){return(e,f)=>{const o=i("v-row");return l(),_(n,{title:"الجنسيات"},{default:a(()=>[t(m,{link:e.route("nationality.create")},null,8,["link"]),t(c,{cols:"12"},{default:a(()=>[t(o,{class:"pt-5"},{default:a(()=>[t(s,{headers:e.headers,data:r.nationalities.data,actions_route:"nationality"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{w as default};