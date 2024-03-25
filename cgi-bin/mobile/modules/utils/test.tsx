// withHooks
import { memo } from 'react';

import { useState, useEffect } from 'react';
import { Text, View, FlatList, Pressable } from 'react-native';

import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import SchoolColors from './schoolcolor';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibUtils } from 'esoftplay/cache/lib/utils/import';
import esp from 'esoftplay/esp';
import { LibList } from 'esoftplay/cache/lib/list/import';
import moment from 'esoftplay/moment';

export interface TestArgs {

}
export interface TestProps {

}



function m(props: TestProps): any {

  const [teacherSchadule, setTeacherSchadule] = useState<any>([])

  useEffect(() => {
    new LibCurl('teacher_schedule', 'get', (result, msg) => {
      console.log('Jadwal Result:', result);
      setTeacherSchadule(result.schedule)

    }, (error) => {
      console.log('error:', error);
    })
  }, [])
  const school = new SchoolColors();




  const refresh = () => {



    LibUtils.debounce(() => {



      new LibCurl('teacher_schedule', null,
        (result, msg) => {
          console.log('Jadwal Result:', result);
          console.log("msg", msg)
          setTeacherSchadule(result.schedule)

        },
        (error) => {
          console.log("error", error)
        })


    }, 100)


  }
  return (
    <View style={{ flex: 1, backgroundColor: 'white', padding: 10, marginTop: LibStyle.STATUSBAR_HEIGHT }}>
      <Text>Test</Text>

      <LibList
        data={teacherSchadule}
        ListHeaderComponent={() => {
          return (
            <View style={{ justifyContent: 'center', padding: 10, backgroundColor: school.bluelight, margin: 5, borderRadius: 10 }}>
              <Text style={{ color: 'white' }}>Mata Pelajaran s</Text>
              <Text style={{ color: 'white' }}>Kelas</Text>

              <View style={{ flexDirection: 'row', justifyContent: 'space-between', flex: 1, height: 50, backgroundColor: 'pink' }}>
                <View style={{ flex: 1, backgroundColor: school.primary, padding: 10, margin: 5, borderRadius: 10, }} >
                  <Pressable onPress={() => { LibDialog.info('test', '') }}>
                    <Text style={{ color: 'white' }}>Jadwal Hari Ini</Text>
                  </Pressable>
                </View>
                <View style={{ flex: 1, backgroundColor: school.bluelight, padding: 10, margin: 5, borderRadius: 10, }} >
                  <Pressable onPress={() => { LibDialog.info('test', '') }}>
                    <Text style={{ color: 'white' }}>Jadwal Hari Ini</Text>
                  </Pressable>
                </View>
              </View>
            </View>
          )
        }}
        ListEmptyComponent={() => {
          return (
            <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
              <Text>Belum ada jadwal</Text>
            </View>
          )

        }}
        onRefresh={refresh}
        renderItem={(item: any) => {
          console.log('item:', item);
          return (
            <View style={{ justifyContent: 'center' }}>
              <Text>{item.status_text}</Text>
              {item.data.map((data: any) => {
                return (
                  <View style={{ flexDirection: 'row', justifyContent: 'space-between', padding: 10, backgroundColor: school.primary, margin: 5, borderRadius: 10 }}>
                    <Text>{data.course.name}</Text>
                    <Text>{data.class.name}</Text>
                  </View>
                )
              })}

            </View>
          )
        }
        } />


    </View>
  );
}


export default memo(m);