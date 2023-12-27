// withHooks
import { memo } from 'react';

import React from 'react';
import { View } from 'react-native';
import Home from './home';


export interface TeacherAccountArgs {
  
}
export interface TeacherAccountProps {
  
}
function m(props: TeacherAccountProps): any {
  return (
    <View style={{flex:1,backgroundColor:'#ff00d4'}}>
      <Home />
    </View>
  )
}
export default memo(m);