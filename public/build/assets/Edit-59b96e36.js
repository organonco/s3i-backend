import{_ as s}from"./MainLayout-91867d8c.js";import{S as m}from"./SimpleFormSheet-d5b651cf.js";import{r as i,o as l,f,w as a,a as o,T as u}from"./app-dddcea2c.js";import"./CenterSheet-c3d1feb1.js";const d={data:function(){return{form:u({name:this.nationality.data.name})}},methods:{submit:function(){this.form.put(route("nationality.update",this.nationality.data.id))}}},h=Object.assign(d,{__name:"Edit",props:{nationality:Object},setup(p){return(e,t)=>{const n=i("v-text-field");return l(),f(s,{title:"تعديل الجنسية"},{default:a(()=>[o(m,{onSave:e.submit},{default:a(()=>[o(n,{label:"اسم الجنسية",variant:"solo",modelValue:e.form.name,"onUpdate:modelValue":t[0]||(t[0]=r=>e.form.name=r),"error-messages":e.form.errors.name},null,8,["modelValue","error-messages"])]),_:1},8,["onSave"])]),_:1})}}});export{h as default};