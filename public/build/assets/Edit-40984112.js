import{_ as f}from"./MainLayout-878f3cbb.js";import{S as p}from"./SimpleFormSheet-2d2670f7.js";import{r as s,o as v,f as b,w as l,a,e as g,T as V}from"./app-92c60662.js";import"./CenterSheet-4bff3cd2.js";const h=["src"],w={data:function(){return{form:V({_method:"put",name:this.teacher.data.name,username:this.teacher.data.username,password:"",bio:this.teacher.data.bio,education:this.teacher.data.education,visible:this.teacher.data.visible,image:""})}},methods:{submit:function(){this.form.post(route("teacher.update",this.teacher.data.id))}}},B=Object.assign(w,{__name:"Edit",props:{teacher:Object},setup(_){return(e,o)=>{const m=s("v-col"),t=s("v-text-field"),n=s("v-textarea"),i=s("v-file-input"),d=s("v-checkbox"),u=s("v-row");return v(),b(f,{title:"تعديل المدرب"},{default:l(()=>[a(p,{cols:"12",onSave:e.submit},{default:l(()=>[a(u,null,{default:l(()=>[a(m,{cols:"6"},{default:l(()=>[g("img",{src:this.teacher.data.image_url,style:{width:"100%"}},null,8,h)]),_:1}),a(m,{cols:"6"},{default:l(()=>[a(t,{label:"اسم المدرب",variant:"solo",modelValue:e.form.name,"onUpdate:modelValue":o[0]||(o[0]=r=>e.form.name=r),"error-messages":e.form.errors.name},null,8,["modelValue","error-messages"]),a(t,{label:"اسم المستخدم",variant:"solo",modelValue:e.form.username,"onUpdate:modelValue":o[1]||(o[1]=r=>e.form.username=r),"error-messages":e.form.errors.username},null,8,["modelValue","error-messages"]),a(n,{label:"لمحة",variant:"solo",modelValue:e.form.bio,"onUpdate:modelValue":o[2]||(o[2]=r=>e.form.bio=r),"error-messages":e.form.errors.bio},null,8,["modelValue","error-messages"]),a(t,{label:"الاختصاص",variant:"solo",modelValue:e.form.education,"onUpdate:modelValue":o[3]||(o[3]=r=>e.form.education=r),"error-messages":e.form.errors.education},null,8,["modelValue","error-messages"]),a(i,{"prepend-icon":"mdi-image",name:"image",label:"الصورة",variant:"solo","error-messages":e.form.errors.image,onInput:o[4]||(o[4]=r=>e.form.image=r.target.files[0])},null,8,["error-messages"]),a(t,{label:"كلمة المرور",variant:"solo",modelValue:e.form.password,"onUpdate:modelValue":o[5]||(o[5]=r=>e.form.password=r),"error-messages":e.form.errors.password,type:"password"},null,8,["modelValue","error-messages"]),a(d,{label:"ظهور في صفحة الكادر التدريسي",modelValue:e.form.visible,"onUpdate:modelValue":o[6]||(o[6]=r=>e.form.visible=r),"true-value":1,"false-value":0},null,8,["modelValue"])]),_:1})]),_:1})]),_:1},8,["onSave"])]),_:1})}}});export{B as default};