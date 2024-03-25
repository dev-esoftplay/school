// withHooks
import { memo } from 'react';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import useSafeState from 'esoftplay/state';
import React, { useEffect, useState } from 'react';
import { FlatList, Platform, Pressable, ScrollView, Text, View } from 'react-native';
import { TouchableOpacity } from 'react-native-gesture-handler';
import SchoolColors from '../utils/schoolcolor';


export interface TeacherMyClassArgs {

}
export interface TeacherMyClassProps {

}
function m(props: TeacherMyClassProps): any {
  const idclass: string = LibNavigation.getArgsAll(props).clasid;
  const school = new SchoolColors();
  function shadowS(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: '#000000', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 }
    }
    return { elevation: value };
  }
  const allTabs = ['Jadwal Kelas', 'Daftar Siswa'];
  const [selectTab, setSelectTab] = React.useState(allTabs[0])
  const [resApi2, setResApi2] = useState<any>([])
  const[teacherSchadule, setTeacherSchadule] = useState<any>([])
  const[allDays, setAllDays] = useState<any>([])
  useEffect(() => {

    // console.log('url :', url)
    new LibCurl('teacher_schedule_class', null, (result) => {
      // console.log('url :', url)
      console.log('Jadwal Result:', result);
      setTeacherSchadule(result.schedules)
      setAllDays(result.days)
    }, () => {
      // console.log("error", err)
    })
    new LibCurl('teacher_student?class_id=' + idclass, null, (result, msg) => {
      // console.log('Jadwal Result besok:', result);
      console.log("msg", msg)
      setResApi2(result)
    }, (err) => {
      console.log("error", err)
    })

  }, [])


  const Tabs = () => {
    if (selectTab == 'Jadwal Kelas') {

      const today = new Date();
      // Mendapatkan nilai antara 0 (Minggu) hingga 6 (Sabtu)

     
      const [selectedDay, setSelectedDay] = useSafeState(allDays[today.getDay()]);

      const renderScheduleItem = ({ item }: { item: any }) => (
        console.log('item', item),
        <View style={{ marginBottom: 20, width: '100%', padding: 5 }}>
          {/* <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000' }}>{item.day}</Text> */}
          <FlatList
            data={item.schedule}
            keyExtractor={(scheduleItem: any) => scheduleItem.schedule_id}
            renderItem={({ item: schedule }: { item: any }) => (
              console.log('schedule', schedule),
              <View key={schedule.schedule_id} style={{ flexDirection: 'row', backgroundColor: '#e7e7e7', borderRadius: 10, marginBottom: 10, height: 100, ...shadowS(6) }}>
                {/* You can customize this part according to your schedule data */}
                <View style={{ marginRight: 10, width: 20, backgroundColor: school.primary, borderBottomLeftRadius: 10, borderTopLeftRadius: 10 }} >

                </View>
                <View style={{ justifyContent: 'center', padding: 10 }}>
                  <Text style={{ fontSize: 16, color: '#555' }}>{schedule.course.name}</Text>
                  <View style={{ flex: 1 }} />
                  <Text style={{ fontSize: 16, color: '#555' }}>{schedule.clock_start} - {schedule.clock_end}</Text>

                </View>
              </View>
            )}
          />
        </View>
      );
      return (
        <View style={{ flex: 1, backgroundColor: 'white' }}>
          <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10, marginBottom: 20 }}>
            <ScrollView horizontal={true} showsHorizontalScrollIndicator={false}>
              {allDays.map((day:any) => (
                <TouchableOpacity
                  key={day}
                  onPress={() => setSelectedDay(day || '')}
                  style={{
                    padding: 10,
                    backgroundColor: selectedDay === day ? school.primary: 'lightgray',
                    borderRadius: 5,
                    marginRight: 10,
                  }}>
                  <Text style={{ color: selectedDay === day ? 'white' : 'black' }}>{day?.toLocaleUpperCase()}</Text>
                </TouchableOpacity>
              ))}
            </ScrollView>
          </View>
          {/* <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000' }}>{selectedDay}</Text> */}
          <FlatList
            data={teacherSchadule.filter((item: { day: string; }) => item.day === selectedDay)}
            scrollEnabled={true}
            keyExtractor={(item, index) => index.toString()}
            contentContainerStyle={{ width: '100%' }}
            renderItem={renderScheduleItem}
          />
        </View>
      );
    } else {


      return (
        <View style={{ flex: 1, }}>
          <FlatList
            // jangan lupa di ganti allStudents jadi resApi2.student_list
            data={resApi2.student_list}
            keyExtractor={(item, index) => index.toString()}
            contentContainerStyle={{ marginTop: 10 }}
            renderItem={({ item }) => (

              <View style={{ marginBottom: 5, width: '100%', padding: 5 }}>
                <Pressable onPress={() => LibNavigation.navigate('teacher/detailstudent',
                  {
                    data: item,
                    class_id: idclass,
                    student_id: item.student_id,
                    parent: item.parent,
                    className: resApi2.class_name,
                    studentName: item.name

                  })} >

                  <View style={{ flexDirection: 'row', backgroundColor: 'white', borderRadius: 10, padding: 15, ...shadowS(6),borderWidth:2,borderColor:school.primary }}>
                    <View style={{ marginRight: 10, width: 50, height: 50, borderRadius: 25, backgroundColor: '#69656586', justifyContent: 'center', alignItems: 'center' }} >
                      <LibIcon.AntDesign name='user' size={30} color='black' />
                    </View>
                    <View style={{ justifyContent: 'center' }}>
                      <Text style={{ fontSize: 16, fontWeight: 'bold', color: school.primary }}>{item.name}</Text>
                      <Text style={{ fontSize: 16, fontWeight: '500', color: school.primary }}>No.absen {item.number}</Text>
                      {/* <Text style={{ fontSize: 16, color: '#4e4c4c' }}>{item.parent.dada}</Text> */}
                    </View>
                  </View>
                </Pressable>
              </View>
            )}
          />
        </View>
      )
    }
  }
  return (
    <View style={{ padding: 20, flex: 1, paddingTop: LibStyle.STATUSBAR_HEIGHT }}>

      <ScrollView showsVerticalScrollIndicator={false} >

        <View style={{ marginBottom: 30 }}>
          <Pressable onPress={() => { LibNavigation.back() }} style={{ height: 40, borderRadius: 20,  }}>
            <View style={{ justifyContent: 'flex-start', alignItems: 'center', flexDirection: 'row', }}>
              <LibIcon.EntypoIcons name='chevron-left' size={35} color='gray' />
              <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000' }}>Kembali</Text>
            </View>
          </Pressable>


          <View style={{ flexDirection: 'row', backgroundColor: 'white', alignItems: 'center', justifyContent: 'space-between', marginTop: 20 }}>
            <Text style={{ fontSize: 30, fontWeight: 'bold', color: 'black' }}>{resApi2?.class_name ?? 'class_name'}</Text>
            {/* <Pressable onPress={() => schaduleData()} style={{ alignSelf: 'center', borderRadius: 10, backgroundColor: '#dfdfdf', opacity: 0.8, padding: 5 }}>
              <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#ff0000' }}>SoeHarto</Text>
            </Pressable> */}
          </View>


        </View>
        <View style={{ flexDirection: 'row', marginBottom: 20, justifyContent: 'center' }}>

          <TouchableOpacity onPress={() => setSelectTab(allTabs[0])} key={0}
            style={{
              paddingVertical: 15, paddingHorizontal: 5, backgroundColor: selectTab === allTabs[0] ? school.primary: '#FFFFFF',
              justifyContent: 'center', alignItems: 'center', marginLeft: 15, ...shadowS(6), width: LibStyle.width * 0.5 - 25, borderBottomLeftRadius: 10, borderTopLeftRadius: 10,

            }}>
            <Text style={{ color: selectTab === allTabs[0] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{allTabs[0]}</Text>
          </TouchableOpacity>
          <TouchableOpacity onPress={() => setSelectTab(allTabs[1])} key={1}
            style={{
              paddingVertical: 15, paddingHorizontal: 32, backgroundColor: selectTab === allTabs[1] ? school.primary: '#FFFFFF',
              justifyContent: 'center', alignItems: 'center', marginRight: 15, ...shadowS(6), width: LibStyle.width * 0.5 - 25, borderBottomRightRadius: 10, borderTopRightRadius: 10,
            }}>
            <Text style={{ color: selectTab === allTabs[1] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{allTabs[1]}</Text>
          </TouchableOpacity>
        </View>

        <Tabs />
      </ScrollView>


    </View>
  )
}


export default memo(m);