// withHooks
import { useEffect } from 'react';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { Auth } from '../auth/login';
import { UserClass } from 'esoftplay/cache/user/class/import';
import { Dimensions, FlatList, Platform, Pressable, Text, View } from 'react-native';
import esp from 'esoftplay/esp';
import { LibStyle } from 'esoftplay/cache/lib/style/import';






export interface MainIndexArgs {

}
export interface MainIndexProps {

}
export default function m(props: MainIndexProps): any {

  const user = UserClass.state().useSelector(s => s);

  // esp.log(user);
  useEffect(() => {
    esp.log('1');
    if (user) {
      esp.log('2');
  
      // console.log('user.group_ids[0]:',user[0].group_ids[0]);
      // // console.log('ids type:',typeof user[0].group_ids[0]);
      // if (user?.group_ids[0] == "6") {
      //   esp.log('3');
      //   LibNavigation.replace('parent/index')
      // } else if (user?.group_ids[0] == "5") {
      //   esp.log('4');
        
      //   LibNavigation.replace('teacher/index')
      // }else{
      //   UserClass.delete()
      //   LibNavigation.reset()
      // }
    }else {
      
       LibNavigation.replace('auth/login')
    }
  }, [])
      function elevation(value: any) {
        if (Platform.OS === "ios") {
            if (value === 0) return {};
            return { shadowColor: 'black', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
        }
        return { elevation: value };
    }

    const roles = (ids:string) => {
      switch(ids){
        case "6":
          LibNavigation.replace('parent/index')
          break;
        case "5":
          LibNavigation.replace('teacher/index')
          break;
      }
    }
    const role = (ids:string) => {
      switch(ids){
        case "6":
          return "Orang Tua"
          break;
        case "5":
          return "Guru"
          break;
      }
    }

  return (
    <View style={{flex:1,justifyContent:'center',marginTop:LibStyle.STATUSBAR_HEIGHT,alignItems:'center'}}>

      <Text style={{ color: '#000000', fontSize: 25, fontWeight: 'bold' ,marginBottom:25,marginTop:50}}> Pilih Peran Kamu</Text>
   
      <FlatList data={user?.group_ids ?? []}
          style={{ height: 'auto', }}
          showsVerticalScrollIndicator={false}
          keyExtractor={(item, index) => index.toString()}
          renderItem={
            ({ item }) => {
              console.log("item", item)
              //<Text>{item['subject_id']['class_id'].major}</Text>
              return (
                <Pressable onPress={() => roles(item)} style={{ backgroundColor: 'white', padding: 10, margin: 10,height:150,marginHorizontal:20,...elevation(7),alignItems:'center',justifyContent:'center',width:LibStyle.width-40,borderRadius:15 }}>
                <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold' }}>{role(item)}</Text>
              </Pressable>
              )
            }
          } />


    </View>
  );

}