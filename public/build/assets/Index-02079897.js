import{_ as s}from"./MainLayout-269de27d.js";import{_ as n}from"./DataTable-6de7eba7.js";import{r as i,o as l,f as c,w as t,a as e}from"./app-9a15cd0e.js";import{C as _}from"./CreateButton-d19eaa06.js";import{C as m}from"./CenterSheet-544a1c2b.js";import"./ConfirmationDialog-d4164ae0.js";const d={data(){return{headers:[{title:"الرمز",align:"start",key:"id"},{title:"الاسم",align:"start",key:"name"}]}}},y=Object.assign(d,{__name:"Index",props:{categories:Array},setup(r){return(a,f)=>{const o=i("v-row");return l(),c(s,{title:"الاختصاصات"},{default:t(()=>[e(_,{link:a.route("category.create")},null,8,["link"]),e(m,{cols:"12"},{default:t(()=>[e(o,{class:"pt-5"},{default:t(()=>[e(n,{headers:a.headers,data:r.categories.data,actions_route:"category","delete-message":"حذف الاختصاص سيؤدي الى حذفه وحذف كل الدورات التابعة له"},null,8,["headers","data"])]),_:1})]),_:1})]),_:1})}}});export{y as default};
