// withHooks
import React, { memo } from 'react';
import { useEffect } from 'react';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { Auth } from '../auth/login';
import { UserClass } from 'esoftplay/cache/user/class/import';
import { Pressable, Text, View } from 'react-native';
import esp from 'esoftplay/esp';
import { LibStyle } from 'esoftplay/cache/lib/style/import';




export interface MainIndexArgs {

}
export interface MainIndexProps {

}
function m(props: MainIndexProps): any {

  const user = UserClass.state().useState()

  esp.log(user);
  useEffect(() => {
    if (user) {
      console.log('user:',user);
      console.log('user.group_ids:',user[0]?.group_ids);
      console.log('user.group_ids[0]',typeof user[0].group_ids[0])
      // user.group_ids: ["6","5"]
      if (user[0]?.group_ids[0] == "6") {
        LibNavigation.replace('parent/index')
      } else if (user[0]?.group_ids[0] == "5") {
        LibNavigation.replace('teacher/index')
      }else{
        UserClass.delete()
        LibNavigation.reset()
      }
    }else {
      
       LibNavigation.replace('auth/login')
    }
  }, [user])

  return (
    <View style={{paddingTop: LibStyle.STATUSBAR_HEIGHT}}>
      <Text>main</Text>
      <Pressable onPress={() => {   LibNavigation.replace('parent/index')}} style={{ backgroundColor: 'red', padding: 10, margin: 10 }}>
        <Text>parent</Text>
      </Pressable>
      
      <Pressable onPress={() => {   LibNavigation.replace('teacher/index')}} style={{ backgroundColor: 'red', padding: 10, margin: 10 }}>
        <Text>teacher</Text>
      </Pressable>
    </View>
  );

}
export default memo(m);