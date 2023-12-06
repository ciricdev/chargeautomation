
var ECS_hooks = {};

var ECS_Columns_Count=0;

function ECS_add_action(name, func) {
  if(!ECS_hooks[name]) ECS_hooks[name] = [];
  ECS_hooks[name].push(func);
}

function ECS_do_action(name, ...params){
  if(ECS_hooks[name]) 
     ECS_hooks[name].forEach(func => func(...params));
}
/*This file was exported by "Export WP Page to Static HTML" plugin which created by ReCorp (https://myrecorp.com) */