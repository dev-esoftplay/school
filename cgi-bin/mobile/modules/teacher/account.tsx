// withHooks
import { memo } from 'react';

import React from 'react';
import { Pressable, Text, View } from 'react-native';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';


export interface TeacherAccountArgs {
  
}
export interface TeacherAccountProps {
  
}
function m(props: TeacherAccountProps): any {
  return (
    
    <View style={{ flex: 1, backgroundColor: 'white' ,}}>
     <Pressable onPress={() =>  LibNavigation.replace('parent/index')}>
      <Text>Parent</Text>
      </Pressable>
    </View>
    
  )
}
export default memo(m);