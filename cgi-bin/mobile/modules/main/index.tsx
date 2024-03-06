// withHooks
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { UserClass } from 'esoftplay/cache/user/class/import';
import esp from 'esoftplay/esp';
import { useEffect } from 'react';
import { FlatList, Platform, Pressable, Text, View } from 'react-native';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibProgress } from 'esoftplay/cache/lib/progress/import';
import { useTimeout } from 'esoftplay/timeout';






export interface MainIndexArgs {

}
export interface MainIndexProps {

}
export default function m(props: MainIndexProps): any {

  const user = UserClass.state().useSelector(s => s);
   const timeout= useTimeout()
  //  esp.log(user);
  useEffect(() => {
    esp.log('1');
    
    if (user) {
      esp.log('2');
      esp.log(user);
      timeout (()=>{
        if (user.group_ids.length == 1) {
          // LibDialog.warning(user.group_ids, user.group_ids.length)
          console.log('3');
          LibProgress.show('Memuat...')
          // roles(user.group_ids)
          switch (user.group_ids[0]) {
            case '5':
              LibNavigation.replace('teacher/index');
              LibProgress.hide();
              break;
            case '6':
              LibNavigation.replace('parent/index');
              LibProgress.hide();
              break;
            default:
              LibProgress.hide();
              LibNavigation.replace('auth/login');
              break;
          }
        }
      }, 500)

    } else {

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
  // ['6']
  const roles = (ids: string) => {
    switch (ids) {
      case "6":
        LibNavigation.replace('parent/index')
        break;
      case "5":
        LibNavigation.replace('teacher/index')
        break;
    }
  }
  const role = (ids: string) => {
    switch (ids) {
      case "6":
        return "Orang Tua"
        break;
      case "5":
        return "Guru"
        break;
    }
  }

   if(user.group_ids.length > 1){
  return (
    <View style={{ flex: 1, justifyContent: 'center', marginTop: LibStyle.STATUSBAR_HEIGHT, alignItems: 'center' }}>

      <Text style={{ color: '#000000', fontSize: 25, fontWeight: 'bold', marginBottom: 25, marginTop: 50 }}> Pilih Peran Kamu</Text>

      {user.group_ids.map((item: any) => (
        <Pressable onPress={() => roles(item)} style={{ backgroundColor: 'white', padding: 10, margin: 10, height: 150, marginHorizontal: 20, ...elevation(7), alignItems: 'center', justifyContent: 'center', width: LibStyle.width - 40, borderRadius: 15 }}>
          <Text style={{ color: '#000000', fontSize: 15, fontWeight: 'bold' }}>{role(item)} ids: {String(item)}</Text>
        </Pressable>
      ))}

    </View>
  );}else{
    return <View/>
  }

}