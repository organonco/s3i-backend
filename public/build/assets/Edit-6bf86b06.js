import{_ as f}from"./MainLayout-a1adb4cb.js";import{S as _}from"./SimpleFormSheet-f9b794fc.js";import{r as t,o as p,f as d,w as n,a as e,T as g}from"./app-15cff6dc.js";import"./CenterSheet-e67cc629.js";const v={data:function(){return{form:g({_method:"put",name:this.category.data.name,icon:""})}},methods:{submit:function(){this.form.post(route("category.update",this.category.data.id))}}},w=Object.assign(v,{__name:"Edit",props:{category:Object},setup(m){return(o,r)=>{const l=t("v-text-field"),s=t("v-col"),i=t("v-img"),u=t("v-row"),c=t("v-file-input");return p(),d(f,{title:"تعديل قسم الكورسات"},{default:n(()=>[e(_,{onSave:o.submit},{default:n(()=>[e(u,null,{default:n(()=>[e(s,{cols:"9"},{default:n(()=>[e(l,{name:"name",label:"اسم القسم",variant:"solo",modelValue:o.form.name,"onUpdate:modelValue":r[0]||(r[0]=a=>o.form.name=a),"error-messages":o.form.errors.name},null,8,["modelValue","error-messages"])]),_:1}),e(s,null,{default:n(()=>[e(i,{src:m.category.data.icon_url,height:"50px"},null,8,["src"])]),_:1})]),_:1}),e(c,{"prepend-icon":"mdi-image",name:"icon",label:"أيقونة القسم",variant:"solo","error-messages":o.form.errors.icon,onInput:r[1]||(r[1]=a=>o.form.icon=a.target.files[0])},null,8,["error-messages"])]),_:1},8,["onSave"])]),_:1})}}});export{w as default};
